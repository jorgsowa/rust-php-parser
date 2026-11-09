===source===
<?php echo readonly::class;
===errors >=8.1===
expected expression, found 'readonly'
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 1
===php_error >=8.2===
PHP Parse error:  syntax error, unexpected token "::", expecting "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "readonly"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 11,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 19
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 21,
                    "end": 26
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 26
            }
          }
        ]
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
