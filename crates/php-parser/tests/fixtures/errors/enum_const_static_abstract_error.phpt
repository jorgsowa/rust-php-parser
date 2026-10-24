===source===
<?php enum Status { static abstract const X = 1; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot use 'static' as constant modifier
Cannot use 'abstract' as constant modifier
===errors 8.1-8.2===
Cannot use 'static' as constant modifier
Cannot use 'abstract' as constant modifier
===errors >=8.3===
Cannot use the static modifier on a class constant
Cannot use the abstract modifier on a class constant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===php_error 8.1-8.2===
PHP Fatal error:  Cannot use 'static' as constant modifier in Standard input code on line 1
===php_error >=8.3===
PHP Fatal error:  Cannot use the static modifier on a class constant in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 46,
                      "end": 47
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
