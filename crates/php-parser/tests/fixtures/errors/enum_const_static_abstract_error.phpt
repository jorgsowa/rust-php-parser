===config===
min_php=8.3
===source===
<?php enum Status { static abstract const X = 1; }
===errors===
cannot use 'static' as constant modifier
cannot use 'abstract' as constant modifier
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "X",
                  "visibility": null,
                  "is_final": false,
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
===php_error===
PHP Fatal error:  Cannot use the static modifier on a class constant in Standard input code on line 1
