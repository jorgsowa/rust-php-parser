===source===
<?php include $dir . '/file.php';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Include",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "dir"
                      },
                      "span": {
                        "start": 14,
                        "end": 18
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "/file.php"
                      },
                      "span": {
                        "start": 21,
                        "end": 32
                      }
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 32
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
