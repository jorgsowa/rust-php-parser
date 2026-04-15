===source===
<?php f(&$a);
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
                  "Identifier": "f"
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 9,
                      "end": 11
                    }
                  },
                  "unpack": false,
                  "by_ref": true,
                  "span": {
                    "start": 8,
                    "end": 11
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "&" in Standard input code on line 1
