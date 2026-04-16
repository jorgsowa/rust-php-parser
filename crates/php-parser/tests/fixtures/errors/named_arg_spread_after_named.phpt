===source===
<?php func(a: 1, ...$args);
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
                      "Variable": "args"
                    },
                    "span": {
                      "start": 20,
                      "end": 25
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 17,
                    "end": 25
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
===php_error===
PHP Fatal error:  Cannot use argument unpacking after named arguments in Standard input code on line 1
