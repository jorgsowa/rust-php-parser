===source===
<?php enum Status { case Active; case Inactive; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
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
                "Case": {
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 25,
                      "end": 31
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 38,
                      "end": 46
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
