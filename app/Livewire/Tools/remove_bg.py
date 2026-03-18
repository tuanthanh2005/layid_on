import sys
import os

try:
    from rembg import remove
    from PIL import Image
    import io

    def process(input_path, output_path):
        with open(input_path, 'rb') as i:
            input_data = i.read()
            output_data = remove(input_data)
            with open(output_path, 'wb') as o:
                o.write(output_data)

    if __name__ == "__main__":
        if len(sys.argv) < 3:
            print("Usage: python remove_bg.py <input_path> <output_path>")
            sys.exit(1)
            
        process(sys.argv[1], sys.argv[2])
        print("SUCCESS")
except Exception as e:
    print(f"ERROR: {str(e)}")
    sys.exit(1)
