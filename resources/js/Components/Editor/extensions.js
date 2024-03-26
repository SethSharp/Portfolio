// Code styling imports
import { createLowlight } from 'lowlight'
import php from 'highlight.js/lib/languages/php'
import typescript from 'highlight.js/lib/languages/typescript'
import plaintext from 'highlight.js/lib/languages/plaintext'
import css from 'highlight.js/lib/languages/css'
import javascript from 'highlight.js/lib/languages/javascript'
import json from 'highlight.js/lib/languages/json'
import sql from 'highlight.js/lib/languages/sql'
import yaml from 'highlight.js/lib/languages/yaml'

// TipTap imports
import { Extension } from '@tiptap/vue-3'
import Link from '@tiptap/extension-link'
import Text from '@tiptap/extension-text'
import Document from '@tiptap/extension-document'
import ListItem from '@tiptap/extension-list-item'
import Paragraph from '@tiptap/extension-paragraph'
import Underline from '@tiptap/extension-underline'
import HardBreak from '@tiptap/extension-hard-break'
import TextAlign from '@tiptap/extension-text-align'
import CodeBlockLowlight from '@tiptap/extension-code-block-lowlight'
import Image from '@/Components/Editor/Nodes/Image/Image.js'
import { Heading } from '@/Components/Editor/CustomExtensions/Heading.js'

const lowlight = createLowlight()

lowlight.register({ php, typescript, plaintext, css, javascript, json, sql, yaml })

const Extensions = Extension.create({
    addExtensions() {
        return [
            CodeBlockLowlight.configure({
                lowlight,
                languageClassPrefix: 'language-',
            }),
            Document,
            Heading,
            Paragraph.configure({
                HTMLAttributes: {
                    style: 'color: #475569;',
                },
            }),
            Link.configure({
                openOnClick: false,
                HTMLAttributes: {
                    style: 'color: #1d4ed8;',
                },
            }),
            ListItem,
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
            Text,
            Underline,
            Image,
            HardBreak,
        ]
    },
})

export default Extensions
