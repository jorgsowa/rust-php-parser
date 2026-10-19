===source===
<?php (void) getVersion();
===errors 8.4===
'void cast' requires PHP 8.5 or higher
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected identifier "getVersion" in Standard input code on line 1
===ast >=8.4===
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
                            "getVersion"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 13,
                            "end": 23
                          }
                        }
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
