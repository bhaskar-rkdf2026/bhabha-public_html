import sys
import re

def process_file(filepath):
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Add loading="lazy" to <img> tags that don't already have a loading attribute
        new_content = re.sub(r'<img (?![^>]*loading=)', '<img loading="lazy" ', content)
        
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Successfully processed {filepath}")
    except Exception as e:
        print(f"Error processing {filepath}: {e}")

process_file('index.php')
process_file('inc.gallery.php')
process_file('about.php')
