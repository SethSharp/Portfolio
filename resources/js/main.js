import './bootstrap'
import '../css/app.css'
import hljs from 'highlight.js'
import php from 'highlight.js/lib/languages/php'

hljs.registerLanguage('php', php)

hljs.highlightAll()
