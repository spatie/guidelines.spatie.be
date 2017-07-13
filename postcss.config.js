module.exports = {
    plugins: [
        require('postcss-easy-import')({
            glob: true,
        }),
        require('postcss-cssnext')({
            browsers: 'last 2 versions',
        }),
    ],
};
