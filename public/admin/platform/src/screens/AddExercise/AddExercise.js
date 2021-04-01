import React from 'react'
import { Row, Col } from 'react-bootstrap'
import { Link, useParams } from 'react-router-dom'
import { labels } from '../../assets/translations/labels'
import Layout from '../../layouts/Layout'

function AddExercise() {

    const { chapter } = useParams()

    const renderLink = (link, label) => <Col md="4">
        <Link to={link} className="add-container d-flex flex-column justify-content-center align-items-center p-3 bg-white border mb-3">
            <i className="fa fa-plus fa-3x mb-3"></i>
            <h3 className="text-center">{label}</h3>
        </Link>
    </Col>

    return (
        <Layout title={labels.add_exercise}>
            <Row>
                {renderLink(`/${chapter}/exercise/puzzle`, labels.puzzle)}
                {renderLink(`/${chapter}/exercise/painting-images`, labels.painting)}
                {renderLink(`/${chapter}/exercise/shape-drawings`, labels.shape_drawings)}
                {renderLink(`/${chapter}/exercise/matching-words-to-sentences`, labels.matching_words_to_sentences)}
                {renderLink(`/${chapter}/exercise/matching-words-with-images`, labels.matching_words_to_images)}
                {renderLink(`/${chapter}/exercise/suitable-words`, labels.suitable_words)}
                {renderLink(`/${chapter}/exercise/memory-game`, labels.memory_game)}
                {renderLink(`/${chapter}/exercise/multiple-choices`, labels.multiple_choices)}
                {renderLink(`/${chapter}/exercise/wordwall-exam`, labels.wordwall_exam)}
            </Row>
        </Layout>
    )
}

export default AddExercise
