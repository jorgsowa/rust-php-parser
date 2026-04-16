===source===
<?php func(a: 1, 2);
===errors===
cannot use positional argument after named argument
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
                  "Identifier": "func"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "args": [
                {
                  "name": "a",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 14,
                      "end": 15
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 15
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 17,
                    "end": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
===php_error===
PHP Fatal error:  Cannot use positional argument after named argument in Standard input code on line 1
