===source===
<?php enum Status { abstract public function label(): string; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Class Status contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (Status::label)
===errors 8.1===
Class Status contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (Status::label)
===errors 8.2-8.4===
Enum Status must implement 1 abstract private method (Status::label)
===errors >=8.5===
Enum method Status::label() must not be abstract
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===php_error 8.1===
PHP Fatal error:  Class Status contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (Status::label) in Standard input code on line 1
===php_error 8.2-8.4===
PHP Fatal error:  Enum Status must implement 1 abstract private method (Status::label) in Standard input code on line 1
===php_error >=8.5===
PHP Fatal error:  Enum method Status::label() must not be abstract in Standard input code on line 1
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
                "Method": {
                  "name": {
                    "name": "label",
                    "span": {
                      "start": 45,
                      "end": 50
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 54,
                          "end": 60
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 60
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
