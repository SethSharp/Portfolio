import placeholderCover from '../../../public/images/default.avif'

const getBlogCoverImage = (cover) => {
    if (cover) {
        return cover
    }

    return placeholderCover
}

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
    })
}

export { getBlogCoverImage, formatDate }
