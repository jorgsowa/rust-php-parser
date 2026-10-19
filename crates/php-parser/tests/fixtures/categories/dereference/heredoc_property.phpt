===source===
<?php
echo <<<X
a
X->b;
===errors===
Cannot dereference this expression
===php_error===
PHP Parse error:  syntax error, unexpected token "->", expecting "," or ";" in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Heredoc": {
                      "label": "X",
                      "parts": [
                        {
                          "Literal": "a"
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 19
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "b"
                  },
                  "span": {
                    "start": 21,
                    "end": 22
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
