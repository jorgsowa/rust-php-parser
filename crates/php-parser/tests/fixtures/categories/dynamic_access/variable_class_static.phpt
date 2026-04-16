===source===
<?php $class::CONST_NAME;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Variable": "class"
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "member": {
                "name": "CONST_NAME",
                "span": {
                  "start": 14,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
