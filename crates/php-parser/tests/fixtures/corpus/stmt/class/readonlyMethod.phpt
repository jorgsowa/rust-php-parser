===source===
<?php class A { readonly function foo() {} }
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
Cannot use the readonly modifier on a method
===errors >=8.1===
Cannot use the readonly modifier on a method
===php_error <=8.2===
PHP Fatal error:  Cannot use 'readonly' as method modifier in Standard input code on line 1
===php_error >=8.3===
PHP Fatal error:  Cannot use the readonly modifier on a method in Standard input code on line 1
===ast >=7.4===
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
                    "name": "foo",
                    "span": {
                      "start": 34,
                      "end": 37
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
