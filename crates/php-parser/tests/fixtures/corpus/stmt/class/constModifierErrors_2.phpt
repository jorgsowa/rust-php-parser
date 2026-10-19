===config===
min_php=8.3
===source===
<?php
class A {
    abstract const X = 1;
}
===errors===
cannot use 'abstract' as constant modifier
===php_error===
PHP Fatal error:  Cannot use the abstract modifier on a class constant in Standard input code on line 3
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
                      "start": 35,
                      "end": 36
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 41
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
