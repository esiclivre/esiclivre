import gulp from 'gulp'
import builderCore from './sources/js/builders/core'
import { taskCss as indexTaskCss } from './sources/js/builders/index'

const folderCss = './assets/css'
const tasksCss = [
    indexTaskCss(gulp, folderCss, 1)
]

builderCore(gulp, tasksCss)
