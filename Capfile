#set :application, "gonaeo"
set :repository,  "git@github.com:monaeo/mixpanel-wordpress.git"
set :user, "deploy"
ssh_options[:forward_agent] = true
set :use_sudo, false
set :srcpath, "/var/www/wp-content/plugins/mixpanel-wordpress"

task :production do
  server 'ws-1.aws.monaeo.com', :app
end

task :deploy do
  run "cd #{srcpath} && git pull"
end
