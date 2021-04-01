import React, { Component } from 'react'
import { baseUrl, routes } from '../providers/routes'

import { CKEditor, CKEditorContext } from '@ckeditor/ckeditor5-react';

import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor'
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import Context from '@ckeditor/ckeditor5-core/src/context';
import List from "@ckeditor/ckeditor5-list/src/list"

import BlockQuote from '@ckeditor/ckeditor5-block-quote/src/blockquote';
import Image from '@ckeditor/ckeditor5-image/src/image';
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar';

import ImageResize from '@ckeditor/ckeditor5-image/src/imageresize';
import ImageUpload from '@ckeditor/ckeditor5-image/src/imageupload';
import Link from '@ckeditor/ckeditor5-link/src/link';
import FontSize from '@ckeditor/ckeditor5-font/src/fontsize.js';
import CKFinder from '@ckeditor/ckeditor5-ckfinder/src/ckfinder.js';
import CKFinderUploadAdapter from '@ckeditor/ckeditor5-adapter-ckfinder/src/uploadadapter.js';

import { labels } from '../assets/translations/labels'



class RichTextEditor extends Component {

    constructor(props) {
        super(props)

        this.state = {
            text: ''
        }
    }

    render() {
        const { value, onChange } = this.props // <- Dont mind this, just handling objects from props because Im using this as a shared component.

        return (
            <CKEditorContext context={Context}>
                <CKEditor
                    editor={ClassicEditor}
                    config={{
                        plugins: [CKFinder, Image, ImageToolbar, ImageStyle, CKFinderUploadAdapter, FontSize, Paragraph, Bold, Italic, Essentials, Alignment, List, BlockQuote, Link, ImageUpload, ImageResize],
                        toolbar: [
                            'fontSize',
                            'bold', 'italic', '|',
                            'alignment:left', 'alignment:center', 'alignment:right', '|',
                            'bulletedList', 'numberedList', '|',
                            'blockQuote', 'link', '|',
                            'undo', 'redo',
                            'ImageUpload'
                        ],
                        ckfinder: {
                            uploadUrl: `${baseUrl + 'api/' + routes.uploadImageCKEditor}`,
                            options: {
                                resourceType: 'Images'
                            }
                        },
                        image: {
                            styles: [
                                'alignLeft', 'alignCenter', 'alignRight'
                            ],

                            resizeOptions: [
                                {
                                    name: 'resizeImage:original',
                                    label: labels.original_size,
                                    value: null
                                },
                                {
                                    name: 'resizeImage:50',
                                    label: '50%',
                                    value: '50'
                                },
                                {
                                    name: 'resizeImage:75',
                                    label: '75%',
                                    value: '75'
                                }
                            ],

                            toolbar: [
                                'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
                                '|',
                                'resizeImage',
                                '|',
                                'imageTextAlternative'
                            ]
                        }
                    }}
                    data={value}
                    onChange={(event, editor) => {
                        onChange(editor.getData())
                    }}

                />
            </CKEditorContext>
        )
    }
}

export default RichTextEditor