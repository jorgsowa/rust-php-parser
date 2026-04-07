===source===
<?php require __DIR__ . '/config.php';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Require",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "MagicConst": "Dir"
                      },
                      "span": {
                        "start": 14,
                        "end": 21
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "/config.php"
                      },
                      "span": {
                        "start": 24,
                        "end": 37
                      }
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 37
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
