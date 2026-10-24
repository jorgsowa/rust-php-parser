===source===
<?php class A { abstract const X = 1; }
===errors <=8.2===
Cannot use 'abstract' as constant modifier
===errors >=8.3===
Cannot use the abstract modifier on a class constant
===php_error <=8.2===
PHP Fatal error:  Cannot use 'abstract' as constant modifier in Standard input code on line 1
===php_error >=8.3===
PHP Fatal error:  Cannot use the abstract modifier on a class constant in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 31,
                      "end": 32
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 37
              }
            }
          ],
          "attributes": []
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
