===source===
<?php
class C { #[A] use T; }
===errors >=8.5===
expected 'function' or 'const', found 'use'
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected token "use", expecting "function" or "const" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "use", expecting "function" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 25,
                        "end": 26
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 16,
                "end": 27
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
