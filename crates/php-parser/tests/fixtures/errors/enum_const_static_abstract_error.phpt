===source===
<?php enum Status { static abstract const X = 1; }
===errors >=8.3===
cannot use 'static' as constant modifier
cannot use 'abstract' as constant modifier
===php_error===
PHP Fatal error:  Cannot use the static modifier on a class constant in Standard input code on line 1
===ast >=8.3===
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
