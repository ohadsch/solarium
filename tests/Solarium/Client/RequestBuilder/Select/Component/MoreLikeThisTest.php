<?php
/**
 * Copyright 2011 Bas de Nooijer. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this listof conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are
 * those of the authors and should not be interpreted as representing official
 * policies, either expressed or implied, of the copyright holder.
 */

class Solarium_Client_RequestBuilder_Select_Component_MoreLikeThisTest extends PHPUnit_Framework_TestCase
{

    public function testBuild()
    {
        $builder = new Solarium_Client_RequestBuilder_Select_Component_MoreLikeThis;
        $request = new Solarium_Client_Request();

        $component = new Solarium_Query_Select_Component_MoreLikeThis();
        $component->setFields('description,name');
        $component->setMinimumTermFrequency(1);
        $component->setMinimumDocumentFrequency(3);
        $component->setMinimumWordLength(2);
        $component->setMaximumWordLength(15);
        $component->setMaximumQueryTerms(4);
        $component->setMaximumNumberOfTokens(5);
        $component->setBoost(true);
        $component->setQueryFields('description');
        $component->setCount(6);
        
        $request = $builder->build($component, $request);
            
        $this->assertEquals(
            array(
                'mlt' => 'true',
                'mlt.fl' => 'description,name',
                'mlt.mintf' => 1,
                'mlt.mindf' => 3,
                'mlt.minwl' => 2,
                'mlt.maxwl' => 15,
                'mlt.maxqt' => 4,
                'mlt.maxntp' => 5,
                'mlt.boost' => 'true',
                'mlt.qf' => 'description',
                'mlt.count' => 6,
            ),
            $request->getParams()
        );

    }

}
