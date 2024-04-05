import placeholderCover from '../../../public/images/default.avif'

const getBlogCoverImage = (cover) => {
    if (cover) {
        return cover
    }

    return placeholderCover
}

export { getBlogCoverImage }
