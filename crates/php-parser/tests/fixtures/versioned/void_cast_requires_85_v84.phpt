===config===
parse_version=8.4
===source===
<?php (void) getVersion();
===errors===
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
                        "Identifier": "getVersion"
                      },
                      "span": {
                        "start": 13,
                        "end": 23
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 13,
                  "end": 25
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
