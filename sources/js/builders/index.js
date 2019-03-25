import rename from 'gulp-rename'
import sass from 'gulp-sass'

const name = 'index'
const idTaskCss = 'build-index-css'

function taskCss(gulp, destiny, version)
{
    gulp.task(idTaskCss, () => {
        return gulp.src([
            'sources/sass/pages/index.sass'
        ])
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(rename(`${name}-v${version}.css`))
        .pipe(gulp.dest(destiny))
    });

    return idTaskCss
}

export { taskCss }
