let g:quickrun_config['php'] = {}
let g:quickrun_config['php']['command'] = 'make'
let g:quickrun_config['php']['cmdopt'] = '-C docker run'
let g:quickrun_config['php']['exec'] = '%c %o SRC=@%'

let g:quickrun_config['php.unit'] = {}
let g:quickrun_config['php.unit']['command'] = 'make'
let g:quickrun_config['php.unit']['cmdopt'] = '-C docker run-test'
let g:quickrun_config['php.unit']['exec'] = '%c %o SRC=@%'
