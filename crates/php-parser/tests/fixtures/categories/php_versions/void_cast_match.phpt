===source===
<?php (void)match($x) { default => 1 };
===errors <=7.4===
'void cast' requires PHP 8.5 or higher
'match expressions' requires PHP 8.0 or higher
===errors 8.0-8.4===
'void cast' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'match' (T_STRING) in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "match" in Standard input code on line 1
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
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 35,
                            "end": 36
                          }
                        },
                        "span": {
                          "start": 24,
                          "end": 36
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 38
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 38
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
