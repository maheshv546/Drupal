npm error code EACCES
npm error syscall rename
npm error path /usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/corepack
npm error dest /usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/.corepack-zqbmuIoc
npm error errno -13
npm error Error: EACCES: permission denied, rename '/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/corepack' -> '/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/.corepack-zqbmuIoc'
npm error     at async Object.rename (node:internal/fs/promises:785:10)
npm error     at async moveFile (/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/npm/node_modules/@npmcli/fs/lib/move-file.js:30:5)
npm error     at async Promise.allSettled (index 0)
npm error     at async #reifyPackages (/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/npm/node_modules/@npmcli/arborist/lib/arborist/reify.js:309:11)
npm error     at async Arborist.reify (/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/npm/node_modules/@npmcli/arborist/lib/arborist/reify.js:121:5)
npm error     at async Install.exec (/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/npm/lib/commands/install.js:152:5)
npm error     at async Npm.exec (/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/npm/lib/npm.js:209:9)
npm error     at async module.exports (/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/npm/lib/cli/entry.js:67:5) {
npm error   errno: -13,
npm error   code: 'EACCES',
npm error   syscall: 'rename',
npm error   path: '/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/corepack',
npm error   dest: '/usr/local/share/.nvm/versions/node/v24.14.1/lib/node_modules/.corepack-zqbmuIoc'
npm error }
npm error
npm error The operation was rejected by your operating system.
npm error It is likely you do not have the permissions to access this file as the current user
npm error
npm error If you believe this might be a permissions issue, please double-check the
npm error permissions of the file and its containing directories, or try running
npm error the command again as root/Administrator.
npm error A complete log of this run can be found in: /var/www/.npm/_logs/2026-04-07T07_12_25_605Z-debug-0.log
