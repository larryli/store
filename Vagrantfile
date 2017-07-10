require 'yaml'
require 'fileutils'

config = {
  local: './supports/dev/vagrant-local.yml',
  example: './supports/dev/vagrant-local.example.yml'
}

# copy config from example if local config not exists
FileUtils.cp config[:example], config[:local] unless File.exist?(config[:local])
# read config
options = YAML.load_file config[:local]

# vagrant configurate
Vagrant.configure(2) do |config|
  # select the box
  config.vm.box = 'ubuntu/xenial64'

  # should we ask about box updates?
  config.vm.box_check_update = options['box_check_update']

  config.vm.provider 'virtualbox' do |vb|
    # machine cpus count
    vb.cpus = options['cpus']
    # machine memory size
    vb.memory = options['memory']
    # machine name (for VirtualBox UI)
    vb.name = options['machine_name']
  end

  # machine name (for vagrant console)
  config.vm.define options['machine_name']

  # machine name (for guest machine console)
  config.vm.hostname = options['machine_name']

  # nginx port
  config.vm.network 'forwarded_port', guest: 8080, host: 8080, host_ip: '127.0.0.1'

  # provisioners
  config.vm.provision 'shell', path: './supports/dev/once-as-root.sh'
  config.vm.provision 'shell', path: './supports/dev/once-as-ubuntu.sh', privileged: false
  config.vm.provision 'shell', path: './supports/dev/always-as-root.sh', run: 'always'

  # post-install message (vagrant console)
  config.vm.post_up_message = 'Website URL: http://127.0.0.1:8080'

  # disable log
  config.vm.provider 'virtualbox' do |vb|
    vb.customize ['modifyvm', :id, '--uartmode1', 'disconnected']
  end
end
