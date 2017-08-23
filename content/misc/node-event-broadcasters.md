# Node Event Broadcasters

Here's a quick guide on how to set up a node event broadcaster. We use these in applications that use socket.io.

The node process will be run by supervisord. First create a new supervisor program in `/etc/supervisor/conf.d/broadcaster.conf`.

```
[program:broadcaster]
command=node /home/forge/xxxxx/broadcaster/server.js
directory=/home/forge/xxxxx
autostart=true
autorestart=true
startretries=3
stderr_logfile=/var/log/broadcaster.err.log
stdout_logfile=/var/log/broadcaster.out.log
user=forge
```

When the program is ready, run it with these commands:

```bash
supervisorctl reread
supervisorctl update
```

You can check the status by running `sudo supervisorctl`

For a more detailed guide, refer to [Servers for Hackers](https://serversforhackers.com/monitoring-processes-with-supervisord).
