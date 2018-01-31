# GenAvatar
## A simple recreation of GitHubs random avatars

This is a simple PHP library that recreates the random avatars GitHub creates for every user.
It uses a seed for the generation and has various settings.

### Usage

```
// Including the Library
include('class.genAvatar.php');

// Setting a Header
header("Content-type: image/png");

// Creating a GenAvatar instance with the seed
$ga = new GenAvatar('github');

// Output the image content
echo $ga->generate(128, "#ffffff", "#ffd001");
```

### Functions

#### Generate
Generates a GenAvatar

```
$genAvatar->generate($outputSize, $backgroundHex, $foregroundHex);
```

#### Parameters
| Parameter       | Type      | Example | Explaination                                                                                                 |
| --------------- | --------- | ------- | ------------------------------------------------------------------------------------------------------------ |
| size            | integer   | 128     | Output size of the image. Keep in mind, that the GenAvatar always has a pattern size of 8 and gets upsampled |
| backgroundColor | Hex Color | #ffffff | The background color of the GenAvatar                                                                        |
| foregroundColor | Hex Color | #ffd001 | The foreground color of the GenAvatar                                                                        |

### License
This project is licensed under the MIT License. To read the license, click [here](LICENSE.md).  
For a simple explaination what you can and cannot do, click [here](tldrlegal.com/license/mit-license)