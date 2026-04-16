===source===
<?php match($x) { 1 => }
===errors===
expected expression
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              },
              "arms": [
                {
                  "conditions": [
                    {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ],
                  "body": {
                    "kind": "Error",
                    "span": {
                      "start": 23,
                      "end": 24
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 24
                  }
                }
              ]
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
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "}" in Standard input code on line 1
