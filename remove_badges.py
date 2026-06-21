import re
import glob

# For JSIT badge in hero
hero_path = 'd:/PJBL_2C/resources/views/public/home/partials/hero.blade.php'
try:
    with open(hero_path, 'r', encoding='utf-8') as f:
        hero = f.read()
    hero = re.sub(r'<div class="inline-flex[^>]*>\s*<i[^>]*>\s*</i>\s*Sekolah Islam Terpadu \(JSIT\)\s*</div>', '', hero, flags=re.MULTILINE|re.DOTALL)
    with open(hero_path, 'w', encoding='utf-8') as f:
        f.write(hero)
    print("Updated hero")
except Exception as e:
    print('Hero error:', e)

# For section-badge globally
files = glob.glob('d:/PJBL_2C/resources/views/**/*.blade.php', recursive=True)
for filepath in files:
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        new_content = re.sub(r'<span class="section-badge[^>]*>.*?</span>\s*', '', content, flags=re.MULTILINE|re.DOTALL)
        if new_content != content:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print('Updated:', filepath)
    except Exception as e:
        print('Error on', filepath, e)
