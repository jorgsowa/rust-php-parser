===source===
<?php @include 'optional.php';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "Include": [
                  "Include",
                  {
                    "kind": {
                      "String": "optional.php"
                    },
                    "span": {
                      "start": 15,
                      "end": 29
                    }
                  }
                ]
              },
              "span": {
                "start": 7,
                "end": 29
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
