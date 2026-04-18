===config===
min_php=8.4
max_php=8.4
===source===
<?php (void) getVersion();
===errors===
'void cast' requires PHP 8.5 or higher (targeting PHP 8.4)
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
