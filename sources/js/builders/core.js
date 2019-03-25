export default function(gulp, tasksCss)
{
    gulp.task('build-css', gulp.series(tasksCss));

    gulp.task('build', gulp.series('build-css'))

    gulp.task('watch-css', function(){
        gulp.watch('sources/sass/**/*.*', gulp.series('build'))
    })
}
