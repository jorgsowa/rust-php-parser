===config===
min_php=8.1
===source===
<?php enum Status { private final const PRIV = 1; }
===errors===
Private constant cannot be final as it is not visible to other classes
===php_error===
PHP Fatal error:  Private constant Status::PRIV cannot be final as it is not visible to other classes in Standard input code on line 1
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
                    "name": "PRIV",
                    "span": {
                      "start": 40,
                      "end": 44
                    }
                  },
                  "visibility": "Private",
                  "is_final": true,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 47,
                      "end": 48
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
