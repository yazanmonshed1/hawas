import React, { useState } from 'react'
import Layout from './layouts/Layout'
import { labels } from './assets/translations/labels'
import { useDispatch, useSelector } from 'react-redux'
import { Link, } from 'react-router-dom'
import TitleField from './components/TitleField'
import { Button, Toast } from 'react-bootstrap'
import { routes } from './providers/routes'
import { post } from './providers/services'
import { addChapter, setChapters, setErrors, showToastr } from './actions'

function Chapters() {

    const dispatch = useDispatch()

    const chapters = useSelector(state => state.chapters)

    const [title, setTitle] = useState(null)
    const [toastr, setToastr] = useState(false)
    const [selectedChapter, setSelectedChapter] = useState(null)

    const handleResponse = (response, json) => {
        switch (response.status) {
            case 201:
                dispatch(setErrors(null))
                dispatch(showToastr(false))
                dispatch(addChapter(json.data))
                setTitle(null)
                break;
            case 422:
                dispatch(showToastr(true))
                dispatch(setErrors(json.errors))
                break;
        }
    }

    const handleRemove = async chapter_id => {
        const options = {
            route: `${routes.chapter.delete}/${chapter_id}`
        }
        const response = await post(options)
        await response.json().then(json => {
            if (response.status == 200) {
                dispatch(setChapters(json.data))
            }
        })
    }

    const handleSubmit = async (title) => {
        const options = {
            route: routes.chapter.create,
            body: {
                chapter: title
            }
        }

        const response = await post(options)

        await response.json().then(json => handleResponse(response, json))
    }

    const renderChapter = (chapter) => <Link key={chapter.id} to={`${chapter.id}/contents`}>
        <h3 className="d-flex justify-content-between align-items-center p-3 m-3 bg-white border" key={chapter.id}>
            {chapter.chapter}
            <div>
                <Button className="btn-danger" onClick={(e) => {
                    setSelectedChapter(chapter.id)
                    e.preventDefault()
                    setToastr(true)
                }}>
                    <i className="i fa fa-trash"></i>
                    test
                </Button>
            </div>
        </h3>
    </Link>

    return <Layout title={labels.chapters} main={true}>
        <div className="bg-white p-3 border">
            <h4>{labels.add_chapter}</h4>
            <TitleField value={title} onChange={setTitle} />
            <Button onClick={() => handleSubmit(title)}>{labels.add}</Button>
        </div>
        {chapters.map(chapter => renderChapter(chapter))}
        <Toast className="redux-bootstrap-toastr" onClose={() => setToastr(false)} show={toastr}>
            <Toast.Header className="bg-danger">
                <strong className="mr-auto text-white">اذا قمت بازالة هذا الفصل سوف تزل كل الدروس التي بداخله. هل انت متأكد؟</strong>
            </Toast.Header>
            <Toast.Body className="bg-white">
                <Button onClick={() => {
                    let chapter_id = selectedChapter;
                    setSelectedChapter(null)
                    handleRemove(chapter_id)
                    setToastr(false)
                }}>{labels.yes}</Button>
                <Button className="btn-danger mx-3" onClick={() => setToastr(false)}>{labels.no}</Button>
            </Toast.Body>
        </Toast>
    </Layout>
}

export default Chapters
