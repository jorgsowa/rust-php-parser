===source===
<?php $factory()();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Variable": "factory"
                      },
                      "span": {
                        "start": 6,
                        "end": 14
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
