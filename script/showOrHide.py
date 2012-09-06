#!/usr/bin/env python
# 显示或隐藏 隐藏文件
#@author tian<sffytian@gmail.com>

import sys
import os

if __name__ == '__main__':
    if len(sys.argv) > 1:
        if "hide" == sys.argv[1]:
            os.system('defaults write com.apple.finder AppleShowAllFiles FALSE')
            os.system('killall Finder')
        else:
            os.system('defaults write com.apple.finder AppleShowAllFiles TRUE')
            os.system('killall Finder')
    else:
        print 'please enter command: hide or show'
    print 'down!'
