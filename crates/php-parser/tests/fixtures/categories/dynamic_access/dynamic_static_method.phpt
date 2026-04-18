===source===
<?php $class::$method();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Variable": "class"
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "method": {
                "kind": {
                  "Variable": "method"
                },
                "span": {
                  "start": 14,
                  "end": 21
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
