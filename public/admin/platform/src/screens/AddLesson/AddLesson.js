import React from 'react'
import Layout from '../../layouts/Layout'
import { Col, Row } from 'react-bootstrap'
import { Link, useParams } from 'react-router-dom'
import { labels } from '../../assets/translations/labels'

function AddLesson() {

    const { chapter } = useParams()

    const renderLink = (link, label) => <Col md="4">
        <Link to={link} className="add-container d-flex flex-column justify-content-center align-items-center p-3 bg-white border mb-3">
            <i className="fa fa-plus fa-3x mb-3"></i>
            <h3 className="text-center">{label}</h3>
        </Link>
    </Col>

    return (
        <Layout title={labels.add_lesson}>
            <Row>
                {renderLink(`/${chapter}/lesson/video`, labels.video)}
                {renderLink(`/${chapter}/lesson/story`, labels.story)}
            </Row>
        </Layout>
    )
}

export default AddLesson
