===config===
min_php=8.3
===source===
<?php class A { readonly const X = 1; }
===errors===
cannot use 'readonly' as constant modifier
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "X",
                  "visibility": null,
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
===php_error===
PHP Fatal error:  Cannot use the readonly modifier on a class constant in Standard input code on line 1
