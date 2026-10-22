===source===
<?php (void)foo();
===errors <=8.4===
'void cast' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'foo' (T_STRING) in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected identifier "foo" in Standard input code on line 1
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
                        "Name": {
                          "parts": [
                            "foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 12,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 17
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
