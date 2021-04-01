import React, { useState, useEffect } from 'react'
import { baseUrl, routes } from '../providers/routes';
import { useDispatch } from 'react-redux'
import { post } from '../providers/services';
import Loader from "react-loader-spinner";
import "react-loader-spinner/dist/loader/css/react-spinner-loader.css";
import { setErrors, showToastr } from '../actions';
import { labels } from '../assets/translations/labels';

function FileUploader({ name, label, setFilePath, initFile, video = false, type = 'image' }) {

    const [fileLabel, setFileLabel] = useState(labels.upload_image)

    const [uploadedFile, setUploadedFile] = useState(false)

    const [loading, setLoading] = useState(false)

    const dispatch = useDispatch()

    useEffect(() => {
        if (label) {
            setFileLabel(label)
        }
    }, [label])

    useEffect(() => {
        if (initFile) {
            setUploadedFile(baseUrl + 'storage/' + initFile)
            setFileLabel('<i class="fa fa-check text-success"></i>')
        }
    }, [initFile])

    const handleChange = (e) => {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        const image = createFile(files[0]);
    }

    const uploadFile = async (fileData) => {
        let route;
        switch (type) {
            case 'audio':
                route = routes.uploadAudio
                break
            case 'video':
                route = routes.uploadVideo
                break
            case 'image':
                route = routes.uploadImage
        }
        const options = {
            route: route,
            body: {
                [type]: fileData
            }
        }
        const response = await post(options)
        setLoading(false)
        await response.json().then(json => {
            if (response.status == 200) {
                setFileLabel('<i class="fa fa-check text-success"></i>')
                setUploadedFile(baseUrl + 'storage/' + json.path)
                setFilePath(json.path)
                setLoading(false)
            } else if (response.status == 422) {
                dispatch(setErrors(json.errors))
                dispatch(showToastr(true))
            }
        })

    }

    const createFile = (file) => {
        setLoading(true)
        let reader = new FileReader();
        reader.onload = (e) => {
            uploadFile(e.target.result)
            return e.target.result

        };
        reader.readAsDataURL(file);
    }

    const renderFile = () => {
        switch (type) {
            case 'image':
                return <img className="mt-3" src={uploadedFile} />
            case 'video':
                return <a target="_blank" href={uploadedFile}>
                    <i className="fa fa-play mt-3"></i>
                </a>
            case 'audio':
                return <a target="_blank" href={uploadedFile}>
                    <i className="fa fa-volume-up mt-3"></i>
                </a>
        }
    }

    return (
        <div className="file-uploader d-flex flex-column justify-content-center align-items-center">
            {uploadedFile && renderFile()}
            {loading && <Loader color="#556ee6" />}
            <div className="position-relative p-3 h-100 w-100 text-center">
                <label dangerouslySetInnerHTML={{ __html: fileLabel }}></label>
                <input name={name} className="cursor-pointer" type="file" onChange={e => handleChange(e)} />
            </div>
        </div>
    )
}

export default FileUploader
