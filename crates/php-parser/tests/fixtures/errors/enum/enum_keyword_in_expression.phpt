===source===
<?php
echo enum instanceof X;
===errors >=8.1===
expected expression, found 'enum'
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "enum" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "enum"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 11,
                        "end": 15
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 15
                  }
                },
                "op": "Instanceof",
                "right": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "X"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 28
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 28
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
