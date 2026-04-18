===config===
parse_version=8.5
min_php=8.5
===source===
<?php (void)someFn();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "someFn"
                      },
                      "span": {
                        "start": 12,
                        "end": 18
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 20
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
