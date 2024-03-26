import './bootstrap'
import '../css/panda-syntax-light.css'
import hljs from 'highlight.js'
import php from 'highlight.js/lib/languages/php'
import typescript from 'highlight.js/lib/languages/typescript'
import plaintext from 'highlight.js/lib/languages/plaintext'
import css from 'highlight.js/lib/languages/css'
import javascript from 'highlight.js/lib/languages/javascript'
import json from 'highlight.js/lib/languages/json'
import sql from 'highlight.js/lib/languages/sql'
import yaml from 'highlight.js/lib/languages/yaml'

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm'
import { intersect } from '@alpinejs/intersect'

hljs.registerLanguage('php', php)
hljs.registerLanguage('typescript', typescript)
hljs.registerLanguage('plaintext', plaintext)
hljs.registerLanguage('css', css)
hljs.registerLanguage('javascript', javascript)
hljs.registerLanguage('json', json)
hljs.registerLanguage('sql', sql)
hljs.registerLanguage('yaml', yaml)

hljs.highlightAll()

Alpine.plugin(intersect)

Livewire.start()
