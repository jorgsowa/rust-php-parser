===source===
<?php
echo <<<X
a
X?->b();
===errors <=7.4===
Cannot dereference this expression
'nullsafe operator (?->)' requires PHP 8.0 or higher
===errors >=8.0===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 4
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "?->", expecting "," or ";" in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "NullsafeMethodCall": {
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
                "method": {
                  "kind": {
                    "Identifier": "b"
                  },
                  "span": {
                    "start": 22,
                    "end": 23
                  }
                },
                "args": []
              }
            },
            "span": {
              "start": 11,
              "end": 25
            }
          }
        ]
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
