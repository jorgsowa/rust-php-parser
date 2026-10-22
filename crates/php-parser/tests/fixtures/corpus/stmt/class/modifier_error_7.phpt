===source===
<?php class A { abstract final function a(); }
===errors <=8.4===
cannot use 'abstract' and 'final' together
Class A contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (A::a)
===errors >=8.5===
cannot use 'abstract' and 'final' together
Class A declares abstract method a() and must therefore be declared abstract
===php_error <=8.2===
PHP Fatal error:  Cannot use the final modifier on an abstract class member in Standard input code on line 1
===php_error >=8.3===
PHP Fatal error:  Cannot use the final modifier on an abstract method in Standard input code on line 1
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
                "Method": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "is_abstract": true,
                    "is_final": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
